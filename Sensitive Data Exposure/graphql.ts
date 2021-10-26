import depthLimit from 'graphql-depth-limit'
import express from 'express'
import graphqlHTTP from 'express-graphql'
import schema from './schema'


const app = express() 
// depthlimit prevents nested queries
app.use('/graphql', graphqlHTTP((req, res) => ({ 
  schema,
  validationRules: [ depthLimit(10) ]
})))
