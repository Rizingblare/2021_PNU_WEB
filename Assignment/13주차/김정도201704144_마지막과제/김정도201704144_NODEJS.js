const express = require('express');
const app = express();
const port = 3000;
const maria = require('mysql');
const conn = maria.createConnection({
    host: 'localhost',
    port: 3306,
    user: 'root',
    password: '000000',
    database: '201704144',
})

conn.connect();

app.use(express.static('public'));
app.use(express.urlencoded( {extended : false } )); 

var linkTitle;
var linkSrc;
app.post('/ajax',function(req,res){
    linkTitle = req.body.linkTitle;
    linkSrc = req.body.linkSrc;
    conn.query(`INSERT INTO bookmark(Title,Link) VALUES('${linkTitle}','${linkSrc}')`,
    function(error, rows, fields){
        if(!error) {
            var responseData = {}
            responseData.linkTitle = linkTitle;
            responseData.linkSrc = linkSrc;
    
            res.json(responseData);
        }
        else {
            console.log(error);
        }
    }) 
})
app.put('/ajax',function(req,res){
    linkTitle = req.body.linkTitle;
    conn.query(`DELETE FROM bookmark WHERE Title='${linkTitle}'`,
    function(error, rows, fields){
        if (!error) {
            res.end();
        }
        else {
            console.log(error);
        }
    }) 
})
app.delete('/ajax',function(req,res){
    conn.query(`DELETE FROM bookmark`,
    function(error, rows, fields){
        if (!error) {
            res.end();
        }
        else {
            console.log(error);
        }
    }) 
})
app.get('/ajax',function(req,res){
    conn.query(`SELECT * FROM bookmark`,
    function(error, rows, fields){
        if(!error) {
            res.send(rows);
        }
        else {
            console.log(error);
        }
    }) 
})
app.get('/',(req,res)=>res.send("http://localhost:3000/김정도201704144_HTML.html <= URL을 입력하세요."))

app.listen(port, ()=> console.log(`Example app listening at http://localhost:${port}`));