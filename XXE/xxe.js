const express = require('express')
const libxmljs = require('libxml')
const db = require('db');
const router = express.Router()

router.post('/upload-products', (req, res) => {
    const XMLfile = req.files.products.data;
	const products = libxmljs.parseXmlString(XMLfile, {noent:true,noblanks:true})

	products.root().childNodes().forEach(product => {
		let newProduct = new db.Product()
		newProduct.name = product.childNodes()[0].text()
		newProduct.description = product.childNodes()[3].text()
		newProduct.save()
    });
    
    res.send('Thanks')
})

module.exports = router
