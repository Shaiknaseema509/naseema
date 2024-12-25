// import { combineReducers, configureStore } from "@reduxjs/toolkit"
// import storage from "redux-persist/lib/storage"
// import { persistReducer } from "redux-persist"
// import viewallusersSlice from '../src/storeSlices/ViewUserSlice'


// const appReducer = combineReducers({
//     viewall: viewallusersSlice,
// })

// const rootReducer = (state, action) => {
    
//     return appReducer(state, action);
// };

// const persistConfig = {
//     key: "root",
//     storage
// };
// const persistedReducer = persistReducer(persistConfig, rootReducer);
// export default configureStore({
//     reducer: persistedReducer,
//     middleware: getDefaultMiddleware =>
//         getDefaultMiddleware({
//             serializableCheck: false,
//         }),

// })