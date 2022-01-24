const express = require('express');
const app = express();
const port = 3000;
const maria = require('mysql');
const db_info = {
    host: 'localhost',
    port: 3306,
    user: 'root',
    password: '000000',
    database: '201704144',
}
// dbConfig를 만들어놓고 mysql 객체 createConnection("Here!")에서 활용

app.use(express.static('public'));
app.use(express.json());
//app.use(express.urlencoded( {extended : false } )); // jQuery용 required_body_data일 때

var linkName;
var linkAddress;
var linkClass;
var linkImage;
app.post('/ajax',function(req,res){
    console.log("POST MODE");
    const conn = maria.createConnection(db_info);
    conn.connect();
    console.log(req.body);
    
    linkName = req.body.client_linkName;
    linkAddress = req.body.client_linkAddress;
    linkClass = req.body.client_linkClass;
    linkImage = req.body.client_linkImage;

    conn.query(`INSERT INTO bookmarkinfo(name,address,class,icon) VALUES('${linkName}','${linkAddress}','${linkClass}','${linkImage}')`,
    function(error, rows, fields){
        if(!error) {
            var responseData = {}
            responseData.server_linkName = linkName;
            responseData.server_linkAddress = linkAddress;
            res.json(responseData);
        }
        else {
            console.log(error);
        }
    })
    conn.end();
})

app.delete('/ajax',function(req,res){
    console.log("DELETE MODE");

    linkTitle = req.body.client_linkTitle;
    
    const conn = maria.createConnection(db_info);
    conn.connect();
    var sql_query = "DELETE FROM bookmark";
    if(linkTitle !== undefined){
        sql_query += " WHERE Title='"+linkTitle+"'";
        console.log("undefined 말고 다른게 실행됨");
    }
    conn.query(sql_query,
    function(error, rows, fields){
        if (!error) {
            res.end();
        }
        else {
            console.log(error);
        }
    })
    conn.end();
})
app.get('/ajax',function(req,res){
    const conn = maria.createConnection(db_info);
    conn.connect();
    conn.query(`SELECT * FROM bookmarkinfo`,
    function(error, rows, fields){
        if(!error) {
            //console.log(rows);
            //console.log(typeof(rows));
            res.json(rows);
        }
        else {
            console.log(error);
        }
    }) 
    conn.end();
})
app.get('/',(req,res)=>res.send("http://localhost:3000/김정도201704144_HTML.html <= URL을 입력하세요."))

app.listen(port, ()=> console.log(`Example app listening at http://localhost:${port}`));