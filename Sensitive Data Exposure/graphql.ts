import express from 'express';
import bodyParser from 'body-parser';
import { graphqlExpress } from 'graphql-server-express';
import NoIntrospection from 'graphql-disable-introspection';

const myGraphQLSchema = MySessionAwareGraphQLSchema;// ... define or import your schema here!
const PORT = 3000;

var app = express(); //dcexpect DisablePoweredBy

//dcexpect LimitGraphqlDepth
app.use('/graphql', bodyParser.json(), graphqlExpress({
   schema: myGraphQLSchema,
  validationRules: [NoIntrospection]
}));




//dcexpect LimitGraphqlDepth
app.use('/graphql', bodyParser.json(), graphqlExpress({ //dcexpect IntrospectionEnabled
   schema: myGraphQLSchema,
 // validationRules: [NoIntrospection]
}));
app.listen(PORT)
