const Excel = require("../models/excel");
const fs = require('fs');
const csv = require('csvtojson')

excelData = [];
module.exports = {
    
    addData: async (req, res) => {
        try {
            const jsonArray = await csv().fromFile('./uploads/' + req.file.filename);
            const result = await Excel.insertMany(jsonArray);
            result ? res.status(200).send({
                message: 'Data saved',
                res: result
            }) :
                res.status(422).send({
                    message: 'data are not saved',
                    res: result
                });
        } catch (error) {
            console.log(error);
            res.send(error);
        }
    },

    getAllData: async (req, res) => {
        try {
            let result = await Excel.find().limit(5);
            result ? res.status(200).send({
                message: 'results are getting',
                res: result
            }) :
                res.status(422).send({
                    message: 'results are not getting',
                    res: result
                });
        } catch (error) {
            console.log(error);
            res.send(error);
        }
    },


    getSpecificData: async (req, res) => {
        try {
            const result = await Excel.findById({
                _id: req.params.dataId
            })
            result ? res.status(200).send({
                message: 'particular data received',
                res: result
            }) :
                res.status(422).send({
                    message: 'particular data not received',
                    res: result
                })
        } catch (error) {
            throw error;
        }
    },

    deleteSpecificData: async (req, res) => {
        try {
            let result = await Excel.findByIdAndDelete({
                _id: req.params.dataId
            });
            result ? res.status(200).send({
                message: 'Data deleted successfully',
                res: result
            }) :
                res.status(422).send({
                    message: 'Data not deleted'
                });
        } catch (error) {
            throw error;
        }
    },
    deleteAllData: async (req, res) => {
        try {
            let result = await Excel.deleteMany({});
            result ? res.status(200).send({
                message: 'Data All deleted successfully',
                res: result
            }) :
                res.status(422).send({
                    message: 'Data not deleted'
                });
        } catch (error) {
            throw error;
        }
    },

    updateSpecificData: async (req, res) => {
        try {
            const result = await Excel.findOneAndUpdate({
                _id: req.params.dataId
            }, {
                title: req.body.title,
                cvss: req.body.cvss,
            });
            result ? res.status(200).send({
                message: 'data update successfully',
                res: result
            }) :
                res.status(422).send({
                    message: 'data not updated',
                    res: result
                });
        } catch (error) {
            throw error;
        }
    }
}
