import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Link} from 'react-router-dom'
import Signup from './Components/Signup/'
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
        <Route path='/signup' component={Signup}/>
    </div>
</BrowserRouter>, document.getElementById('root'));

// ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
