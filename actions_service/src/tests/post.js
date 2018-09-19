const request = require('request');

const data = {
    "name": "Dinesh Chugtai",
    "email": "dinesh@piedpiper.com",
};

request.post({
    url: 'http://localhost:8080/users',
    body: data,
    json: true,
}, function (error, response, body) {
    console.log(body);
});