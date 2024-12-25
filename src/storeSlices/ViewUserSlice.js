import { createSlice } from '@reduxjs/toolkit'

export const viewallusersSlice = createSlice({
    name: 'viewallusers',
    initialState: {
        viewusers_list: {

        }
    },
    reducers: {
        setViewUserList: (state, data) => {
            console.log("before", state.viewusers_list)
            state.viewusers_list = data.payload
            console.log("after", state.viewusers_list)
        }
    }
})

// Action creators are generated for each case reducer function
export const { setViewUserList } = viewallusersSlice.actions

export default viewallusersSlice.reducer