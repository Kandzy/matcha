import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Link} from 'react-router-dom'
import Signin from './Components/Signin/'
import Signup from './Components/Signup/'
import Users from './Components/Users/'
import Navbar from './Components/Navbar/'
import Welcome from './Components/Welcome/'
import registerServiceWorker from './registerServiceWorker';

// const Signup = () => {
//     return <h1>THIS IS SHIT</h1>;
// };

ReactDOM.render(
<BrowserRouter>
    <div>
        <Navbar/>
        <Route exact path='/' component={Welcome}/>
        <Route path='/signin' component={Signin}/>
        <Route path='/signup' component={Signup}/>
        <Route path='/users' component={Users}/>
    </div>
</BrowserRouter>, document.getElementById('root'));

// ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
