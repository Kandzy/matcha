import React from 'react'
import axios from 'axios'
import {Input, Button, Icon} from 'react-materialize'

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

            <div className="container row col s6 offset-s3">
                <div className="col s6 offset-s3">
                    <h4 className="col s3 m4 offset-s2 offset-m4">Signin:</h4>
                    <Input  type="email" label="Login" value={this.state.Login} onChange={this.handleLoginChange} s={12} />
                    <Input  type="password" label="Password" value={this.state.Password} onChange={this.handlePasswordChange} s={12} />
                    <Button waves='light' className="col s8 m4 offset-s2 offset-m4"  onClick={this.handleRegistration}>Submit<Icon right>send</Icon></Button>
                </div>
            </div>

        );
    };
}
export default Signin