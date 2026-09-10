const API_URL = 'http://10.83.10.161/back_andre/public/api';
export const api = {
    post: async (route, body) => {
        return await fetch(API_URL + route, {
            headers: {
                'Content-Type': 'application/json',
            },
            method: 'post',
            body: JSON.stringify(body)
        })
    }
}