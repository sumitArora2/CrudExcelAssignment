const express = require("express");
const cors = require("cors");
const mongoose = require("mongoose");
const bodyparser = require('body-parser');
const config = require('./config/database');
const routes = require('./routes/routes');
const PORT = 3000;
const app = express();
app.use(cors());
app.use(bodyparser.json());

mongoose.connect(config.database, { useNewUrlParser: true }, (err) => {
    if (err) {
        console.log(err);
    }
    else {
        console.log('connected to mongodb');
    }
});

app.use('/api', routes);



app.listen(PORT, () => {
    console.log('listening on port: ' + PORT);
});
