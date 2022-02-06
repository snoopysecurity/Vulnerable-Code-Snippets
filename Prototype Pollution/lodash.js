const express = require('express');
const router = express.Router()

const lodash = require('lodash');
 
//if req.body.config == '{"constructor": {"prototype": {"isAdmin": true}}}' it will bypass the authentication
function check(req, res) {

    let config = {};
    lodash.defaultsDeep(config, JSON.parse(req.body.config));
    
    let user = getCurrentUser();
    if(!user){
      user = {};
    }
    
    if (user.isAdmin && user.isAdmin === true) {
        res.send('Welcome Admin')
    }else{
        res.send('Welcome User')
    }
}

//fake function that get current user from session or db
function getCurrentUser(){
  return false;
}


router.post('/check-user',check)

module.exports = router
