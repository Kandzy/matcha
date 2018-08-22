import React from 'react'
import axios from 'axios'

class Users extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            Users: 0,
            userreq: ""
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
            // this.setState({userreq: response});
            // res = response;
            console.log(response.data);
            // return (response.data);
        }).catch(errors => {
            alert(errors)
        });
        // console.log(res);
    }

    render() {
       this.listOfUsers();
        return (
            <div> Users </div>
        );
    }
}

export default Users