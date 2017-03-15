/* jshint node:true */
// https://github.com/rubenv/grunt-mkdir
module.exports = {
    lite: {
        options: {
            create: ['../<%= package.litename %>']
        }
    }
};