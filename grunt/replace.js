/* jshint node:true */
// https://github.com/outaTiME/grunt-replace
module.exports = {

    liteRename: {
        src: [
            '../<%=package.litename%>/style.css'
        ],
        overwrite: true,
        replacements: [{
            from: /Imma/g,
            to: 'Imma Lite'
        }]
    }
};