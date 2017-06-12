<?php
/**
 * Created by PhpStorm.
 * User: tomaszpach
 * Date: 01.06.2017
 * Time: 12:22
 */


/**
 * How to use that.
 * Change 'example' to your field name
 * Set all needed types in 'type' array. You can also add a default values (see example with color).
 * Go to page '/generate-backend.php' and copy your generated backend.
 */

echo '<pre>';
createBackend( [
    [
        'name' => 'header',
        'type' => [ 'input' => 'default', 'size' => '13px', 'color' => '#000' ]
    ]
] );
echo '</pre>';


function createBackend( $args ) {
    $field = '';

    foreach ( $args as $arg ):
        $moduleName = $arg['name'];

        foreach ( $arg['type'] as $key => $type ):
            $default = null;
            if ( is_string( $key ) ) {
                $default = $type;
                $type    = $key;
            }

            if ( $type === 'input' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . $default . "'";
                }
                $field .= <<<EOT
'{$moduleName}Input' => [
    'type'        => 'input:text',
    'label'       => '{$capitalName} input',
    'description' => 'Please input text for {$capitalName} field'{$defaultField}
],

EOT;
                unset( $defaultField );

            }

            if ( $type === 'editor' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . $default . "'";
                }
                $field .= <<<EOT
'{$moduleName}Editor' => [
    'type'        => 'editor',
    'label'       => '{$capitalName} editor',
    'description' => 'Please input description for {$capitalName} field'{$defaultField}
],

EOT;
                unset( $defaultField );

            }

            if ( $type === 'color' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . $default . "'";
                }
                $field .= <<<EOT
'{$moduleName}Color' => [
    'type'        => 'input:color',
    'label'       => '{$capitalName} color',
    'sass'        => true,
    'description' => 'Please input description for {$capitalName} field'{$defaultField}
],

EOT;
                unset( $defaultField );

            }

            if ( $type === 'size' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . $default . "'";
                }
                $field .= <<<EOT
'{$moduleName}Size' => [
    'type'        => 'input:text',
    'label'       => '{$capitalName} size',
    'sass'        => true,
    'description' => 'Please input description for {$capitalName} field'{$defaultField}
],

EOT;
                unset( $defaultField );

            }

            if ( $type === 'switch' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . ( $default ? 'true' : 'false' ) . "'";
                }
                $field .= <<<EOT
'{$moduleName}Switch' => [
    'type'        => 'input:switch',
    'label'       => '{$capitalName} switch',
    'description' => 'Please input description for {$capitalName} field'{$defaultField}
],

EOT;
                unset( $defaultField );

            }

            if ( $type === 'select' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . ( $default ? 'true' : 'false' ) . "'";
                }
                $field .= <<<EOT
'{$moduleName}Select' => [
    'type'        => 'select',
    'label'       => '{$capitalName} select',
    'multiple'    => 'false',
    'options'     => [
        'allowClear'  => true,
    ],
    'values'      => function () {
        return \Nurture\Pagebox\Module\Fields\Builder\Select::postFilter( get_posts( [
            'post_type'      => [ 'post', 'page' ],
            'posts_per_page' => - 1
        ] ), [ 'post_slug' => 'post_name' ] );
    },
    'description' => 'Please input description for {$capitalName} field'{$defaultField}
],

EOT;

                unset( $defaultField );

            }

            // TODO add default values
            if ( $type === 'repeater' ) {
                $capitalName = ucfirst( $moduleName );
                if ( $default !== null ) {
                    $defaultField = ",
    'default'     => '" . ( $default ? 'true' : 'false' ) . "'";
                }
                $field .= <<<EOT
'repeater' => [
    'type'        => 'repeater',
    'label'       => '{$capitalName} repeater',
    'maxItems'    => 3,
    'field'       => [ 
EOT;


                $field .= <<<EOT
        'header'        => [
            'type'          => 'input:text',
            'label'         => 'Label for header repeater',
            'description'   => 'Please enter description for header repeater',
            'default'       => 'default value'
        ],
    ],
    'description' => 'Please input description for {$capitalName} field'{$defaultField}
],

EOT;

                unset( $defaultField );
            }

        endforeach;

    endforeach;

    echo $field;
}