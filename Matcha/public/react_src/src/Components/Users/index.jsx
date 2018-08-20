import React from 'react'
import axios from 'axios'

class Users extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            Users: 0,
        }
        this.listOfUsers = this.listOfUsers.bind(this);
    }

    listOfUsers()
    {
        var data = new FormData();
        data.append('Login', "lol");

        axios({
            url: 'http://localhost:8100/users',

            method: 'get', // default

            headers: {
                'Content-Type': 'multipart/form-data',
            },

            data: data,

            responseType: 'json', // default

        }).then(response => {
            console.log(response.data);
        }).catch(errors => {
            alert(errors)
        });
    }

    render() {
        this.listOfUsers();
        return (
            <div>hello users</div>
        )
    }
}

export default Users