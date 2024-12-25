import { useDispatch, useSelector } from "react-redux";
import { setViewUserList } from "../../src/storeSlices/ViewUserSlice";
export const useGetUserList = () => {
  const dispatch = useDispatch();
  //const signInSliceData = useSelector((state) => state.signIn);
  return async () => {
    let result = await fetch(
      `http://localhost:5600/api/menu/user/data`,
      {
        method: "get",
        headers: new Headers({
          "Content-Type": "application/json",
         // authorization : `${signInSliceData.signInSuccess.refresh_token}`
        }),
      }
    );

    let getusersdata = await result.json();

    await dispatch(setViewUserList(getusersdata));
  };
};
