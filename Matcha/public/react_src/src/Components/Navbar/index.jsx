import React from 'react'
import {Link} from 'react-router-dom'

const Navbar = () =>
{
    return(
        <nav>
            <div>
                <Link  to='/'>Home page</Link>
                <Link  to='/signin'>Signin</Link>
                <Link  to='/signup'>Signup</Link>
                <Link to='/users'>Users</Link>
                {/*<a className="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>*/}
                {/*<a className="nav-item nav-link" href="#">Features</a>*/}
                {/*<a className="nav-item nav-link" href="#">Pricing</a>*/}
                {/*<a className="nav-item nav-link" href="#">About</a>*/}
            </div>
        </nav>
  // <ul>
  //     <li>
  //         <Link to='/'>Home page</Link>
  //     </li>
  //     <li>
  //         <Link to='/signup'>Signup</Link>
  //     </li>
  // </ul>
        )
};

export default Navbar
