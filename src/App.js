// // import logo from './logo.svg';
// // import './App.css';

// //import React from "react";

// import "./styles.css";

// import React, { useState } from "react";

// import images from './images/img.jpg' // relative path to image 


// // function App() {
// //   return (
// //     <div className="App">
// //       <header className="App-header">
// //         <img src={logo} className="App-logo" alt="logo" />
// //         <p>
// //           Edit <code>src/App.js</code> and save to reload.
// //         </p>
// //         <a
// //           className="App-link"
// //           href="https://reactjs.org"
// //           target="_blank"
// //           rel="noopener noreferrer"
// //         >
// //           Learn React
// //         </a>
// //       </header>
// //     </div>
// //   );
// // }

// // export default App;




// //const App = () => {

//  // var message="dynamic message";

//  // var message1="handleClick";

//   //const contacts = [
//   //  { name: "Jenny Han", email: "jenny.han@notreal.com", age: 25 },
//    // { name: "Jason Long", email: "jason.long@notreal.com", age: 45 },
//    // { name: "Peter Pan", email: "peter.pan@neverland.com", age: 100 }
// //];

  
//   //const handleClick = () =>{
//   //  alert("you clicked the message!");
//   //  }


//   //return (
//     // <div>
//     //   <h1>Hello React World</h1>
//     //    <h2>
//     //       Welcome To React Js!
//     //  </h2>
//     //  <h3>{message}</h3>

//     //  <button type="button" onClick={()=> alert("you clicked the message!")} style={{color: "red",padding:"6px",marginRight:"5px"}}>{message}</button>

//     //  <button type="button" onClick={handleClick} style={{color:"blue",padding:"6px"}}>{message1}</button>

//     //  </div>

//     // React.createElement(
//     //   "div",
//     //   null,
//     //   React.createElement("h1", null, "Hello React World"),   // second method 

//     //   React.createElement(
//     //     "h2",
//     //     null,
//     //     "Welcome To React Js!"
//     //   )
//     //   )
// /*<>
// <ContactCard
//   avatar="https://via.placeholder.com/150"
//   name="Jenny Han"
//   email="jenny.han@notreal.com"
//   age={25}
// />
// <ContactCard
//   avatar="https://via.placeholder.com/150"
//   name="Jason Long"
//   email="jason.long@notreal.com"
//   age={45}
// />
// <ContactCard
//   avatar="https://via.placeholder.com/150"
//   name="Peter Pan"
//   email="peter.pan@neverland.com"
//   age={100}
// />
//     </>*/

//   //   <>
//   //   {contacts.map(contact => (
//   //     <ContactCard
//   //       avatar={contact.picture.large}
//   //       name={contact.name.first + " " + contact.name.last}
//   //       email={contact.email}
//   //       age={contact.dob.age}
//   //     />
//   //   ))}
//   // </>

//     // <div className="contact-card">
//     //   <img src="https://via.placeholder.com/150" alt="profile" />
//     //   <div className="user-details">
//     //     <p>Name: Jenny Han</p>
//     //     <p>Email: Jenny.Han@notreal.com</p>
//     //     <p>Age: 25</p>
//     //   </div>
//     // </div>

//  // );
// //}

// const ContactCard = props => {
//   const [showAge, setShowAge] = useState(false);

//   return (
//     <div className="contact-card">
//       <img src={props.avatar} alt="profile" />
//       <div className="user-details">
//         <p>Name: {props.name}</p>
//         <p>Email: {props.email}</p>
//         <button onClick={() => setShowAge(!showAge)}>
// 			Toggle Age 
// 		</button>
//         {showAge && <p>Age: {props.age}</p>}
//       </div>
//     </div>
//   );
// };

// // const ContactCard = () => {
// //   const [showAge, setShowAge] = useState(true);

// //   return (
// //     <div className="contact-card">
      
// //       <img src={images} alt="profile"/> 
// //       <div className="user-details">
// //         <p>Name: Jenny Han</p>
// //         <p>Email: Jenny.Han@notreal.com</p>
// //         <button onClick={() => setShowAge(!showAge)}>Toggle Age</button>
// //         {
// //         showAge === true ? <p>Age: 35</p> : null
// //         }

// //         {
// //       //  showAge && <p>Age: 25</p> 
// //         }

      

// //       </div>
// //     </div>
// //   );
// // };


// const App = () => {
//   const [contacts, setContacts] = useState([]);

// fetch("https://randomuser.me/api/?results=3")
//   .then(response => response.json())
//   .then(data => {
//     console.log(data);
//     setContacts(data.results);
//   });

//   return (
//     <>
//       {contacts.map(contact => (
//         <ContactCard
//           avatar={contact.picture.large}
//           name={contact.name.first + " " + contact.name.last}
//           email={contact.email}
//           age={contact.dob.age}
//         />
//       ))}
//     </>
//   );
// };


// export default App;


// import React, { Component } from 'react';
// import ParentComp from './componets/ParentComp';

// class App extends Component{
// render(){
//   return(
//     <div>
//       <ParentComp />
//     </div>
//   )
// }
// }

// export default App;

// import React from 'react';
// import ChildProps from './componets/ChildProps';

// function App(){
//   return(
//     <div>
// <ChildProps text="srikanth Props" />
//     </div>
//   )
// }
// export default App;

// import React, { useRef } from 'react';

// function App (){

//   const inputRef = useRef(null);

//   const focusInput = ()=>{
//     inputRef.current.focus()
//   }

//   return(
//     <div>
//       <input type='text' ref={inputRef} />
//       <button onClick={focusInput}>Click me</button>
//     </div>
//   )
// }

// export default App;

// import React, { useState, useEffect } from "react";

// function Timer() {
//   const [count, setCount] = useState(0);

//   useEffect(() => {
//     console.log(`You clicked  times`);
//   },[]); // Runs after every render

  
//   return (
//     <div>
//       <p>You clicked {count} times</p>
//       <button onClick={() => setCount(count + 1)}>Click me</button>
//     </div>
//   );
// }

// export default Timer;

// import React, { useState, useMemo } from "react";

// function ExpensiveComputationComponent() {
//   const [count, setCount] = useState(0);
//   const [text, setText] = useState("");

//   // Expensive computation
//   const expensiveValue = useMemo(() => {
//     console.log("Calculating expensive value...");
//     let result = 0;
//     for (let i = 0; i < 1e9; i++) {
//       result += i;
//     }
//     return result;
//   }, [count]); // Recalculates only when `count` changes

//   return (
//     <div>
//       <p>Expensive value: {expensiveValue}</p>
//       <button onClick={() => setCount(count + 1)}>Increment Count ({count})</button>
//       <input value={text} onChange={(e) => setText(e.target.value)} placeholder="Type something" />
//     </div>
//   );
// }

// export default ExpensiveComputationComponent;

// import React, { useState } from 'react';

// function App() {
//   const [email, setEmail] = useState('');

//   function handleEmailChange(event) {
//     setEmail(event.target.value);
//   }

//   return (
//     <input
//       id="email"
//       name="email"
//       type="email"
//       value={email}
//       onChange={handleEmailChange}
//     />
//   );
// }

// import React, { useRef } from 'react';

// function App() {
//   const inputRef = useRef(null);

//   function handleSubmit(event) {
//     event.preventDefault();
//     console.log('Email:', inputRef.current.value);
//   }

//   return (
//     <form onSubmit={handleSubmit}>
//       <input
//         type="email"
//         ref={inputRef}
//       />
//       <button type="submit">Submit</button>
//     </form>
//   );
// }

// export default App;


// controled component code

// import React, { useState } from 'react';

// function App() {
//   const [name, setName] = useState('');

//   const handleChange = (e) => {
//     setName(e.target.value); // Updates state on user input
//   };

//   const handleSubmit = (e) => {
//     e.preventDefault();
//     console.log(`Submitted Name: ${name}`); // Access state directly
//   };

//   return (
//     <form onSubmit={handleSubmit}>
//       <label>
//         Name:
//         <input type="text" value={name} onChange={handleChange} />
//       </label>
//       <button type="submit">Submit</button>
//     </form>
//   );
// }

// export default App;



// uncontroled component code

// import React, { useRef } from 'react';

// function App() {
//   const inputRef = useRef();

//   const handleSubmit = (e) => {
//     e.preventDefault();
//     console.log(`Submitted Name: ${inputRef.current.value}`); // Access value via ref
//   };

//   return (
//     <form onSubmit={handleSubmit}>
//       <label>
//         Name:
//         <input type="text" ref={inputRef} />
//       </label>
//       <button type="submit">Submit</button>
//     </form>
//   );
// }

// export default App;


import React from 'react';

const App = (props) => {
  return <h1>Welcome, {props.name}!</h1>;
};

export default App; 





