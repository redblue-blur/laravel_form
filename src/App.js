import Admin from "./pages/Admin.js";
import Transaction from "./pages/Transaction.js";
import Login from "./pages/Login.js";
import Home from "./pages/Home.js";
import { BrowserRouter as Router,Route,Switch } from 'react-router-dom';
function App() {
  return (
    <div>
      <Router>
        <Switch>
          <Route path="/admin">
            <Admin/>
          </Route>
        <Route path="/transaction">
            <Transaction/>
          </Route>
          <Route path="/login" >
            <Login/>
          </Route>
          <Route path="/">
            <Home/>
          </Route>
        </Switch>
      </Router>
    </div>
  );
}

export default App;
