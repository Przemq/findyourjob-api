module.exports = function( grunt ) {
    "use strict"; // support for let and const

    // Load grunt tasks automatically
    require( 'load-grunt-tasks' )( grunt );

    // Load module paths
    let modulePaths = [];
    if( grunt.file.exists( 'module-paths.json' )) {
        modulePaths = grunt.file.readJSON( 'module-paths.json' );
    } else {
        grunt.log.error([ 'File module-paths.json does\'t exists! Run local WP site to regenrate this file automatically (WP_DEBUG must be enabled).' ]);
    }

    let getModulePaths = function( suffix ) {
        let path = require("path"),
            paths = [];

        if( modulePaths ) {
            modulePaths.forEach( function( modulePath ) {
                paths.push( path.join( modulePath, suffix ));
            });
        }

        return paths;
    };

    let modulesScssPaths = (function() {
        let paths = {},
            modulePaths = getModulePaths( 'scss/{module,_module-variables}.scss' );

        if( modulePaths ) {
            modulePaths.forEach( function( modulePath ) {
                grunt.file.expandMapping(
                    modulePath,
                    '',
                    { ext: '/../../css/module.css' }
                ).forEach( function( item ) {
                    if( item.src.length === 2 ) {
                        paths[ item.dest ] = item.src[ 1 ];
                    } else {
                        // Skip error for module.scss from module core
                        if( item.src[0] && item.src[0].indexOf('core/scss/module.scss') >= 0 ) return;
                        grunt.log.error([ 'Skipped from compilation (file _module-variables.scss not exist): ' + item.src[ 0 ] ]);
                    }
                });
            });
        }

        return paths;
    })();

    // Project configuration.
    grunt.initConfig( {
        pkg: grunt.file.readJSON( 'package.json' ),
        sass: {
            options: {
                compass: false,
                sourceMap: true,
                outputStyle: 'expanded', // nested, expanded, compact, compressed
                sourceComments: false
            },
            bootstrap: {
                files: {
                    'assets/stylesheets/css/bootstrap.css': 'assets/stylesheets/scss/bootstrap.scss'
                }
            },
            style: {
                files: {
                    'assets/stylesheets/css/style.css': 'assets/stylesheets/scss/style.scss'
                }
            },
            fonts: {
                files: {
                    'assets/stylesheets/css/fonts.css': 'assets/stylesheets/scss/fonts.scss'
                }
            },
            modules: {
                options: {
                    includePaths: [
                        'assets/stylesheets/scss'
                    ]
                },
                files: modulesScssPaths
            }
        },
        watch: {
            options: {
                spawn: false,
                interrupt: true
            },
            gruntfile: {
                files: [
                    'Gruntfile.js',
                    'module-paths.json'
                ],
                options: {
                    reload: true
                }
            },
            sass: {
                files: [
                    'assets/stylesheets/scss/style.scss',
                    'assets/stylesheets/scss/mixins/**/*.scss',
                    'assets/stylesheets/scss/partials/**/*.scss'
                ],
                tasks: [ 'sass:style' ]
            },
            sassBootstrap: {
                files: 'assets/stylesheets/scss/bootstrap.scss',
                tasks: [ 'sass:bootstrap' ]
            },
            sassFonts: {
                files: 'assets/stylesheets/scss/fonts.scss',
                tasks: [ 'sass:fonts' ]
            },
            sassModules: {
                files: getModulePaths( 'scss/**/*.scss' ),
                tasks: [ 'sass:modules' ]
            },
            sassAddedVariables: {
                files: getModulePaths( 'scss/**/*.scss' ),
                options: {
                    event: [ 'added', 'deleted' ],
                    reload: true
                }
            },
            sassThemeConfig: {
                files: 'assets/stylesheets/scss/_theme-config.scss',
                tasks: [ 'sass:style', 'sass:bootstrap' ]
            },
            sassModuleConfig: {
                files: 'assets/stylesheets/scss/_module-config.scss',
                tasks: [ 'sass:modules' ]
            },
            sassVendor: {
                files: 'assets/stylesheets/scss/vendor-config.json',
                tasks: [ 'install-sass-vendor' ]
            },
            bowerVendor: {
                files: 'assets/vendors/vendor-config.json',
                tasks: [ 'install-bower-vendor' ]
            }
        },
        auto_install: {
            local: {
                options: {
                    stdout: true,
                    stderr: true,
                    failOnError: true,
                    npm: false
                }
            }
        },
        copy: {
            sassVendor: {
                files: [] // Initialized in task
            },
            bowerVendor: {
                files: [] // Initialized in task
            }
        },
        clean: {
            cache: ["../../plugins/pagebox/cache/pagebox.cache"],
            sassVendor: ["assets/stylesheets/scss/vendor/"],
            bowerVendor: ["assets/vendors/*/"]
        },
        concat: {
            css: {
                src: [
                    'assets/stylesheets/css/fonts.css',
                    'assets/stylesheets/css/bootstrap.css',
                    'assets/stylesheets/css/style.css'
                ].concat(
                    getModulePaths( 'css/module.css' )
                ),
                dest: 'assets/stylesheets/css/style.min.css'
            }
        },
        cssmin: {
            options: {
                processImport: false,
                shorthandCompacting: true,
                roundingPrecision: 10 // 10 is for bootstrap
            },
            target: {
                files: {
                    'assets/stylesheets/css/style.min.css': ['assets/stylesheets/css/style.min.css']
                }
            }
        }
    } );

    grunt.registerTask( 'install-sass-vendor', 'Install vendors from bower and copy to vendor folder', function() {
        grunt.config.merge({
            copy: {
                sassVendor: {
                    files: grunt.file.readJSON( 'assets/stylesheets/scss/vendor-config.json' )
                }
            }
        });
        grunt.task.run([
            'auto_install',
            'clean:sassVendor',
            'copy:sassVendor'
        ]);
    });

    grunt.registerTask( 'install-bower-vendor', 'Install libs from bower and copy to libs folder', function() {
        grunt.config.merge({
            copy: {
                bowerVendor: {
                    files: grunt.file.readJSON( 'assets/vendors/vendor-config.json' )
                }
            }
        });
        grunt.task.run([
            'auto_install',
            'clean:bowerVendor',
            'copy:bowerVendor'
        ]);
    });

    grunt.registerTask( 'compile', 'Compile scss files with compression', [
        'install-sass-vendor',
        'install-bower-vendor',
        'sass',
        'concat',
        'cssmin'
    ] );

    grunt.registerTask( 'flush-cache', 'Flush Pagebox cache, use with --force flag', [
        'clean:cache'
    ] );

    grunt.registerTask( 'default', 'Watch scss files and compile after change', [
        'watch'
    ] );

};