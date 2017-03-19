/* jshint node:true */
// https://github.com/tomusdrw/grunt-sync
module.exports = {
    syncLite: {
        files: [{
            // cwd: '*',
            src: [
                /* Include Everything */
                '**',

                /* Exclude Utilities */
                '!node_modules/**',
                '!grunt/**',
                '!logs/**',
                '!.idea/**',
                '!package.json',
                '!Gruntfile.js',
                '!.gitignore',
                '!.jshintrc',
                '!phpcs.xml',

                '!inc/features/feature-slider-section.php',
                '!inc/sections/slider-section.php',
            ],
            dest: '../<%= package.litename %>/'
        }],
        updateAndDelete: true,
        failOnError: true,
        verbose: true // Display log messages when copying files
    }
};