import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route} from 'react-router-dom' //Link
import Signin from './Components/Signin/'
import Signup from './Components/Signup/'
import Users from './Components/Users/'
import Profile from './Components/Profile/'
import Forum from './Components/Forum/'
import NavbarMy from './Components/Navbar/'
import Welcome from './Components/Welcome/'
import registerServiceWorker from './registerServiceWorker';

// const Signup = () => {
//     return <h1>THIS IS SHIT</h1>;
// };

ReactDOM.render(
<BrowserRouter>
    <div>
        <NavbarMy/>
        <Route exact path='/' component={Welcome}/>
        <Route path='/signin' component={Signin}/>
        <Route path='/signup' component={Signup}/>
        <Route path='/users' component={Users}/>
        <Route path='/profile' component={Profile}/>
        <Route path='/forum' component={Forum}/>
    </div>
</BrowserRouter>, document.getElementById('root'));

// ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
