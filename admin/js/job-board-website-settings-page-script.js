( function ($) {
    const { ajaxUrl } = jbwSettingsPageScript;

    const settingsPage = {
        init: function() {
            console.log( `jbw-settings-page init` );
            this.formEvents();
        },
        data: {

        },
        formEvents: function () {
            $( document ).on( 'submit', '#jbw-settings-form', function ( e ) {
                e.preventDefault();

                const formData = new FormData( $(this)[0] );
                formData.append( 'action', 'jbw_save_settings' );

                $.ajax({
                    url: ajaxUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function ( res ) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Settings Saved!',
                            text: res?.message
                        });
                    },
                    error: function ( res ) {
                        const response_json = res?.responseJSON;
                        Swal.fire({
                            icon: 'warning',
                            title: response_json?.message,
                            text: 'Please try again'
                        });
                    }
                });
            } )
        }
    };

    $( document ).ready( function () {
        settingsPage.init();
    } );
} )( jQuery );