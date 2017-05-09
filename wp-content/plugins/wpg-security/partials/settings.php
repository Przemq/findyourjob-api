<style>
	.toggle {
		display: inline;
		text-decoration: none;
		font-weight: normal;
		font-size: 10pt;
		margin-left: 20px;
	}
	.toggle:focus {
		color: #0073aa;
		box-shadow: none;
	}
	.accordion > div {
		margin-bottom: 8px;
		border-left: solid 6px #ddd;
	}
	.accordion > div.module-success { border-left-color: forestgreen }
	.accordion > div.module-warning { border-left-color: orange }
	.accordion > div.module-error { border-left-color: red }
	.title-bar {
		border: solid 1px #ddd;
		border-left: 0;
		padding: 8px 10px 8px 26px;
		background: #fff;
		position: relative;
		font-weight: bold;
		cursor: pointer;
		-ms-user-select: none;
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
	}
	.title-bar:before {
		content: "";
		position: absolute;
		top: 14px;
		left: 8px;
		width: 0;
		height: 0;
		border: solid 6px transparent;
		border-bottom: 0;
		border-top: solid 6px #444;
	}
	.hide .title-bar:before {
		transform: rotate(-90deg);
	}
	.title-bar .switch {
		height: 12px;
		display: inline-block;
	}
	.content {
		border: solid 1px #ddd;
		border-left: 0;
		border-top: 0;
		background: #fff;
	}
	.hide .content { display: none }
	.content > .desc {
		padding: 8px 10px;
		background: #f8f8f8;
		font-style: italic;
		color: gray;
	}
	.content form { margin: 0 }
	.content form > .settings {
		padding: 8px 10px;
	}
	.content form > .settings-bar {
		padding: 8px 10px;
		background: #f8f8f8;
	}
	.content form input[type=submit] + span {
		color: gray;
		margin: 0 8px;
		line-height: 28px;
	}
	.content .desc h3 {
		margin: 1em 0 0.4em 0;
	}
	.content .desc p {
		margin: 0.4em 0;
		line-height: 1.6;
	}
	.content form select {
		vertical-align: baseline;
	}
</style>
<div class="wrap">
	<h1>Security Manager</h1>
	<h2>Modules list <a class="toggle" data-toggle="1" href="#">Expand all</a><a class="toggle" data-toggle="0" href="#">Collapse all</a></h2>

	<div class="accordion">
		<?php foreach( $this->getModules() as $module ): ?>
			<div data-id="<?= $module->getId(); ?>" class="hide <?= $this->hasOn( $module ) ? 'module-success' : '' ?>">
				<div class="title-bar">
					<?= $module->getName() ?>
					<div class="switch"><input <?= checked( $this->hasOn( $module ) ) ?> type="checkbox" name="<?= $module->getId(); ?>" value="1"></div>
				</div>
				<div class="content">
					<div class="desc"><?= $module->getDescription() ?></div>
					<?php if( $module instanceof \WPGSecurity\ModuleSettings ): ?>
						<form id="<?= $module->getId(); ?>">
							<div class="settings"><?= $this->renderSettingsView( $module ) ?></div>
							<div class="settings-bar">
								<input type="submit" class="button button-primary" value="Save module settings"><span></span>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<script>
	jQuery( document ).ready( function( $ ) {

		var $accordion = $('.accordion');
		var $modules = $accordion.children();

		$accordion.find('.switch input[type=checkbox]')
			.switchButton({
				labels_placement: "right"
			})
			.change( function() {
				var self = $(this);
				self.prop( "disabled", true );

				var modules = [];
				$modules.each( function( index, module ) {
					var m = $(module);
					if( m.find('.switch input[type=checkbox]').prop( 'checked' ) ) {
						modules.push( m.data('id') );
						m.addClass('module-success');
					} else {
						m.removeClass('module-success');
					}
				});

				jQuery.post( ajaxurl, {
					'action': 'wpg_security_status',
					'modules': modules
				}, function() {
					self.prop( "disabled", false );
				} );
			});

		$('.toggle').click( function( event ) {
			event.preventDefault();
			var toggle = $(this).data('toggle');
			$modules.each( function( index, module ) {
				if( toggle == '0' ) {
					$(module).addClass('hide');
					if( typeof(Storage) !== "undefined" ) window.localStorage.removeItem( $(module).data('id') );
				} else {
					$(module).removeClass('hide');
					if( typeof(Storage) !== "undefined" ) window.localStorage.setItem( $(module).data('id'), true );
				}
			});
		});

		$accordion.find('.title-bar').click( function() {
			var $module = $(this).parent();
			$module.toggleClass('hide');
			// Check browser support for localStorage
			if( typeof(Storage) !== "undefined" ) {
				if( $module.hasClass('hide') ) {
					window.localStorage.removeItem( $module.data('id') );
				} else {
					window.localStorage.setItem( $module.data('id'), true );
				}
			}
		});

		$accordion.find('form').submit( function( event ) {
			event.preventDefault();

			var self = $(this);
			var $submit = self.find('input[type=submit]');
			var $info = $submit.next('span');
			var $inputs = self.find(':input[name]');
			var form = {};

			var submitText = $submit.val();
			$submit.val('Saving...').prop( "disabled", true );

			$inputs.each( function( index, input ) {
				input = $( input );
				if( input.attr('type') == 'checkbox') {
					if( input.prop('checked') ) {
						form[ input.attr( 'name' ) ] = input.val();
					}
				} else {
					form[ input.attr( 'name' ) ] = input.val();
				}
			});

			if( $inputs.length ) {
				jQuery.post( ajaxurl, {
					'action': 'wpg_security_save',
					'id': self.attr( 'id' ),
					'data': form
				}, function() {
					$submit.val( submitText ).prop( "disabled", false );
					$info.text( 'Successfully saved at ' + (new Date()).toGMTString() );
				} );
			} else {
				$submit.val( submitText ).prop( "disabled", true ).hide();
				$info.text( 'Form is empty, no inputs!' );
			}

		});

		if( typeof(Storage) !== "undefined" ) {
			$modules.each( function( index, module ) {
				if( window.localStorage.hasOwnProperty( $(module).data('id') )) {
					$(module).removeClass('hide');
				}
			});
		}

	});
</script>