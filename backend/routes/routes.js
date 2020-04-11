const express =require('express');
const router = express();
var Excel=require('../controllers/excel');
const multer=require('multer');

let UPLOAD_PATH = 'uploads';

var storage = multer.diskStorage({
    destination: function (req, file, cb) {
        cb(null, UPLOAD_PATH);
    },
    filename: function (req, file, cb) {
        console.log("file is",file);
        cb(null, Date.now()+file.originalname );
    }
});
let upload = multer({ storage: storage });


//routes

//posting the csv data into database
router.route('/addData').post(upload.single('myfile'),Excel.addData);
//getting all the data from the database
router.route('/getAllData').get(Excel.getAllData);
//getting the specific/single data from the database
router.route('/getSpecificData/:dataId').get(Excel.getSpecificData);
// delete the data All from the database not used in frontend but only for testing purpose
router.route('/deleteAllData').delete(Excel.deleteAllData);
//delete the specific/single data from the database
router.route('/deleteSpecificData/:dataId').delete(Excel.deleteSpecificData);
// update the single/specific data in database
router.route('/updateSpecificData/:dataId').put(Excel.updateSpecificData);

module.exports = router;