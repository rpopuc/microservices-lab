const mysql = require('mysql');

// Set database connection credentials
const config = {
    host: 'actions_service_database',
    user: 'app',
    password: 'app',
    database: 'app',
};

// Create a MySQL pool
const pool = mysql.createPool(config);

// Export the pool
module.exports = pool;


