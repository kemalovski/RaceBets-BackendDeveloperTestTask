<?php 
?>
./vendor/bin/simple-phpunit --coverage-html reports/

elasticsearch tutorial 

# add
# retrieve
# update
# search

GET _alias

#create a document with id 1

POST  user/_create/1
{
	"name": "Jake",
	"job_desc": "Software developer"
}

POST  user/_create/2
{
	"name": "Hannibal",
	"job_desc": "Product Manager"
}

GET user/_doc/1

# total count of docs in the index

GET user/_count


DELETE user/_doc/2

POST user/_doc/1
{
	"name": "Jake",
	"job_desc": "Software developer 2"
}

GET _search?q=jake

POST user/_doc/1
{
	"name": "Jake",
	"job_desc": "Product Manager"
}


GET _search?q=product


POST  user/_create/3
{
	"name": "Jake the Junior",
	"job_desc": "Product Manager"
}


GET _search?q=name:Jake

GET _search?q=job_desc:Jake

DELETE user





POST  user/_create/3
{
	"name": "Jake the Junior",
	"dob":"2000-12-10",
	"job_desc": "Product Manager"
}

POST  user/_create/1
{
	"name": "Jake",
	"dob":"2000-2-23",
	"job_desc": "Software developer"
}

POST  user/_create/2
{
	"name": "Hannibal",
	"dob":"2020-5-26",
	"job_desc": "Product Manager"
}





######bulk#####

POST _bulk
{ "index" : { "_index" : "test", "_id" : "1" } }
{ "field1" : "value1" }
{ "delete" : { "_index" : "test", "_id" : "2" } }
{ "create" : { "_index" : "test", "_id" : "3" } }
{ "field1" : "value3" }
{ "update" : {"_id" : "1", "_index" : "test"} }
{ "doc" : {"field2" : "value2"} }






GET user/_search
{
  "query": {
    "multi_match": {
      "query":"osman",
      "fields":["name","job_desc"]
    }
  }
}

GET user/_search
{
  "query": {
    "match": {
      "job_desc":"osman"
    }
  }
}



####mapping####



PUT user
{
  "mappings": {
    "properties": {
      "dob":{
        "type": "date"
      },
      "job_desc":{
        "type": "text",
        "index": false
      }
    }
  }
}





POST _bulk
{"create":{"_index":"user","_id":1}}
{"name":"efe","salary":5000,"job_desc":"head manager president"}
{"create":{"_index":"user","_id":2}}
{"name":"kemal","salary":345,"job_desc":"vice president"}
{"create":{"_index":"user","_id":3}}
{"name":"jake","salary":100,"job_desc":"clear"}
{"create":{"_index":"user","_id":4}}
{"name":"lümün","salary":1234124120,"job_desc":"basketçi"}
{"create":{"_index":"user","_id":5}}
{"name":"hakan","salary":200,"job_desc":"tensici"}
{"create":{"_index":"user","_id":6}}
{"name":"jale","salary":220,"job_desc":"bilgisayarcı"}
{"create":{"_index":"user","_id":7}}
{"name":"neşe","salary":500,"job_desc":"accounter"}
{"create":{"_index":"user","_id":8}}
{"name":"asena","salary":12300,"job_desc":"CEO"}



GET user/_search
{
  "query": {
    "bool": {
      "filter": [
        {
          "range": {
            "salary": {
              "gte": 1222
            }
          }
        }
      ]
    }
  }
}

GET user/_search
{
  "query": {
    "bool": {
      "must_not": [
        {
          "match": {
            "name": "asena"
          }
          
        }
      ], 
      "filter": [
        {
          "range": {
            "salary": {
              "gte": 1222
            }
          }
        }
      ]
    }
  }
}

GET user/_search
{
  "query": {
    "bool": {
      "should": [
        {
          "match": {
            "name": "asena"
          }
        },
        {
          "match": {
            "job_desc": "basketçi"
          }
        }
      ]
    }
  }
}