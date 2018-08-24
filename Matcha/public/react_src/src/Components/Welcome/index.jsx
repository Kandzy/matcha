import React from "react"
import axios from "axios"

class Welcome extends React.Component{
    constructor(props){
        super(props);
        this.ShowUsers = this.ShowUsers.bind(this);
        this.state = {
            users: ""
        };
        this.ShowUsers();
    }

    ShowUsers() {
        var data = new FormData();
        data.append('Login', "");
        axios({
            url: 'http://localhost:8100/users',

            method: 'post', // default

            headers: {
                'Content-Type': 'multipart/form-data',
            },

            data: data,

            responseType: 'json', // default

        }).then(response => {
            console.log(response.data);
            this.setState({users: response.data});
        }).catch(errors => {
            alert(errors)
        });

    }
    render()
    {
        var i = 0;
        var ret = '';
        while(this.state.users[i])
        {
            ret += this.state.users[i].Email + " |";
            i++;
        }
        return(
            <div>
                {ret}
            </div>
        )
    }
}

export default Welcome