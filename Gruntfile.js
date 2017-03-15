// jshint node:true

module.exports = function( grunt ) {
    'use strict';

    var loader = require( 'load-project-config' ),
        config = require( 'grunt-theme-fleet' );
    config = config();

    // Remove JS Files
    config.files.js.push( ['!**/bootstrap*.js', 'fontaweseome-iconpicker*.js'] );

    // Remove CSS Files
    config.files.css.push( ['!**/bootstrap*.css', '!**/font-awesome*.css' ] );
    loader( grunt, config ).init();
};