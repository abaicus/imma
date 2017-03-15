/* jshint node:true */
// https://github.com/blazersix/grunt-wp-i18n
module.exports = {
    lite: {
        options: {
            textdomain: '<%= package.theme.textdomain %>-lite',
            updateDomains: ['<%= package.theme.textdomain %>'],

        },
        files: {
            src: [
                '../<%= package.litename %>/**/*.php'
            ]
        }
    }
};