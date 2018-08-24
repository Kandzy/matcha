import React from 'react'
import axios from 'axios'

class Users extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            Users: 0,
            userreq: "",
            login : this.props.match.params.login
        };
        this.userPage = this.userPage.bind(this);
    }

    userPage(login)
    {
        var data = new FormData();
        axios({
            url: 'http://localhost:8100/users/' + login,

            method: 'post', // default

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
        // console.log(res);
    }

    render() {
        // var login = "Aika";
       this.userPage(this.state.login);
        return (
            <div> Users </div>
        );
    }
}

export default Users