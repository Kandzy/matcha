import React from 'react'
import {Navbar, NavItem, Icon} from 'react-materialize';
const NavbarMy = () =>
{
    return(
        <Navbar brand='Matcha' right>
            <NavItem href='/'><Icon>view_module</Icon></NavItem>
            <NavItem href='/signin'><Icon>refresh</Icon></NavItem>
            <NavItem href='/signup'><Icon>more_vert</Icon></NavItem>
        </Navbar>
    )
};
export default NavbarMy

// import React from 'react'
// import {Link} from 'react-router-dom'
//
// const Navbar = () =>
// {
//     return(
//         <nav>
//             <div>
//                 {/*<Link  to='/'><button>Home page</button></Link>*/}
//                 {/*<Link  to='/signin'><button>Signin</button></Link>*/}
//                 {/*<Link  to='/signup'><button>Signup</button></Link>*/}
//                 {/*<Link to='/users'><button>Users</button></Link>*/}
//                 {/*<Link to='/profile'><button>Profile</button></Link>*/}
//                 {/*<Link to='/forum'><button>Forum</button></Link>*/}
//                 {/*<a className="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>*/}
//                 {/*<a className="nav-item nav-link" href="#">Features</a>*/}
//                 {/*<a className="nav-item nav-link" href="#">Pricing</a>*/}
//                 {/*<a className="nav-item nav-link" href="#">About</a>*/}
//             </div>
//         </nav>
//   // <ul>
//   //     <li>
//   //         <Link to='/'>Home page</Link>
//   //     </li>
//   //     <li>
//   //         <Link to='/signup'>Signup</Link>
//   //     </li>
//   // </ul>
//         )
// };

// export default Navbar
