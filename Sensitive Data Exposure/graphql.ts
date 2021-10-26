import express from 'express';
import bodyParser from 'body-parser';
import { graphqlExpress } from 'graphql-server-express';
import NoIntrospection from 'graphql-disable-introspection';

import depthLimit from 'graphql-depth-limit'

const myGraphQLSchema = MySessionAwareGraphQLSchema;// ... define or import your schema here!
const PORT = 3000;

var app = express(); 


app.use('/graphql', bodyParser.json(), graphqlExpress({
   schema: myGraphQLSchema,
  validationRules: [NoIntrospection]
}));





app.use('/graphql', bodyParser.json(), graphqlExpress({ 
   schema: myGraphQLSchema,
   validationRules: [ depthLimit(10) ]
}));
app.listen(PORT)
