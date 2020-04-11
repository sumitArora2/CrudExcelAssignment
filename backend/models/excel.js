const mongoose = require('mongoose');
var Schema = mongoose.Schema;

const ExcelSchema = mongoose.Schema({
    id: {
        type: Number,
        required: true
    },
    level: {
        type: String,
        required: true
    },
    cvss: {
        type: Number,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    Vulnerability: {
        type: String,
        required: true
    },
    Solution:{
        type: String,
        required: true    
    },
    reference:{
        type: String,
        required: true        
    }
});

const Excel = module.exports = mongoose.model('Excel', ExcelSchema);