document.addEventListener('DOMContentLoaded', function () {
    M.Sidenav.init(document.querySelectorAll('.sidenav'), { edge: "right" });
    M.Modal.init(document.querySelectorAll('.modal'), {});

    hljs.initHighlightingOnLoad();
});

const createSiteForm = document.querySelector('form#site');
createSiteForm.addEventListener('submit', e => {
    e.preventDefault();
    const data = formDataToJSON(new FormData(createSiteForm));

    apiUse('post', '/site', data);
})

const codeSite = id => {
    const elem = document.querySelector('#code');
    const instance = M.Modal.getInstance(elem);

    // set text correct id (select span and set value on span)
    instance.open();
}

const deleteSite = id => {
    if (confirm('Are you sure?')) {
        apiUse('delete', `/site/${id}`);
    }
}
