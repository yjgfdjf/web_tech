const getPostIdFromURL = () => {
    const params = new URLSearchParams(window.location.search);
    return params.get('id');
};

const fetchPost = async (id) => {
    try {
        const res = await fetch(`https://jsonplaceholder.typicode.com/posts/${id}`);
        if (!res.ok) throw new Error('Ошибка при получении поста');
        return await res.json();
    } catch (error) {
        console.error('Ошибка загрузки поста:', error);
        return null;
    }
};

const fetchComments = async (postId) => {
    try {
        const res = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}/comments`);
        if (!res.ok) throw new Error('Ошибка при получении комментариев');
        return await res.json();
    } catch (error) {
        console.error('Ошибка загрузки комментариев:', error);
        return [];
    }
};

const renderPost = (post) => {
    const postDiv = document.getElementById('post');
    if (!post) {
        postDiv.innerHTML = '<p>Пост не найден</p>';
        return;
    }
    postDiv.innerHTML = `
        <h1>${post.title}</h1>
        <p>${post.body}</p>
    `;
};

const renderComments = (comments) => {
    const commentsDiv = document.getElementById('comments');
    commentsDiv.innerHTML = '<h2>Комментарии</h2>';
    comments.forEach(comment => {
        commentsDiv.innerHTML += `
            <div class="comment">
                <p><strong>${comment.name}</strong> (${comment.email})</p>
                <p>${comment.body}</p>
            </div>
        `;
    });
};

const init = async () => {
    const postId = getPostIdFromURL();
    const post = await fetchPost(postId);
    renderPost(post);

    const comments = await fetchComments(postId);
    renderComments(comments);
};

init();
