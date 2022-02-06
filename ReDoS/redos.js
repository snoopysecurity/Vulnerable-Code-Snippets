const express = require('express');
const router = express.Router()


router.get("/tstMe", (req, res) => { 
    var r = /([a-z]+)+$/;

    let match = r.test(req.params.id);
    res.send(match)
    
});


module.exports = router
