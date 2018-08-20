import React from 'react'
import axios from 'axios'

class Signin extends React.Component{
    constructor(props)
    {
        super(props);
        // this.handleRegistration.bind(this);
        this.state = {
            Login: "",
            Password: ""
        }
        this.handleLoginChange = this.handleLoginChange.bind(this);
        this.handlePasswordChange = this.handlePasswordChange.bind(this);
        this.handleRegistration = this.handleRegistration.bind(this);
    }

    handleLoginChange(event) {
        console.log('Email changed');
        this.setState({
            Login: event.target.value
        });
    }
    handlePasswordChange(event) {
        console.log('Email changed');
        this.setState({
            Password: event.target.value
        });
    }

    handleRegistration() {
        var data = new FormData();
        data.append('Login', this.state.Login);
        data.append('Password', this.state.Password);
        axios({
            url: 'http://localhost:8100/signin',

            method: 'post', // default

            headers: {
                'Content-Type': 'multipart/form-data',
            },

            data: data,

            responseType: 'json', // default

        }).then(response => {
            console.log(response.data['isLogin']);
            if (response.data['isLogin'])
            {
                window.location.assign('/');
            }
        }).catch(errors => {
            alert(errors)
        });
        // console.log(response.data);

    }

    sendData(){

    }

    render() {
        // this.handleRegistration();
        return(

            <form>
                <input type='text' placeholder='Login' value={this.state.Login} onChange={this.handleLoginChange} />
                <input type='password' placeholder='Password' value={this.state.Password} onChange={this.handlePasswordChange} />
                <button type="button" onClick={this.handleRegistration}>Submit</button>
            </form>
        );
    };
}

export default Signin