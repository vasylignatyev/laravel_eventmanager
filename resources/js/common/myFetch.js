export default function myFetch(url, data, method = "POST") {
    const options = {
        method: method,
        //credentials: "same-origin",
        body: JSON.stringify({...data, _token: this.csrf}),
        //mode: 'no-cors',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": this.csrf,
        },
    };
    return fetch(url, options).then(responce => {
        if( responce.redirected ) {
            window.location.href = responce.url;
        }
        return responce;
    })
    .catch(error => {
        console.log('catch: ', error);
        if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
        }
    });
}
