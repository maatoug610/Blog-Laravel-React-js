import React, { useState } from "react";
import "./login.scss";

const Login = () => {
  const [error, setError] = useState(false)
  
    return (
      <div className="login">
        <form>
          <input type="email" placeholder="email.." />
          <input type="password" placeholder="password.." />
                <button type="submit">Login</button>
                {error == true ? <span>Wrong !!! Password or Email</span> : null}
        </form>
      </div>
    );

}

export default Login;
