import React, {useState, useEffect} from 'react';
import { useNavigate } from "react-router-dom";
import { useGetUserList } from "../services/ViewUserService";
import { useSelector } from "react-redux";

const ViewAllUsers = () => {

  const getUserListRequest = useGetUserList();
  const stateData = useSelector((state) => state.viewall);
  const navigate = useNavigate();
    
  const [rows, setRowData] = useState([]);

useEffect(() => {
    let isAuth = JSON.parse(localStorage.getItem("code"));
    if (!isAuth) {
        navigate("/");
    }
    getAllUserData()
    }, []);

      const getAllUserData = async () => {
        await getUserListRequest();
        console.log(stateData.viewusers_list,"get all user data");
        setRowData(stateData.viewusers_list);
      };

  return (
    <div>
     test...........
    </div>
  )
}

export default ViewAllUsers