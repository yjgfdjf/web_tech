import { Catalog } from "./src/components/catalog.js"

const renderPostItem = item => `
    <a  
        href="post.html?id=${item.id}"
        class="post-item"
    >
        <span class="post-item__title">
            ${item.title}
        </span>

        <span class="post-item__body">
            ${item.body}
        </span>
    </a>
`

const getPostItems = async ({ limit, page }) => {
    try {
        const res = await fetch(`https://jsonplaceholder.typicode.com/posts?_limit=${limit}&_page=${page}`);
        if (!res.ok) throw new Error('Ошибка при получении постов');
        const total = +res.headers.get('x-total-count');
        const items = await res.json();
        return { items, total };
    } catch (error) {
        console.error('Ошибка загрузки постов:', error);
        return { items: [], total: 0 };
    }
}


const renderPhotoItem = item => `
    <a  
        href="photos/${item.id}"
        class="photo-item"
    >
        <span class="photo-item__title">
            ${item.title}
        </span>

        <img 
            src=${item.url}
            class="photo-item__image"
        >
    </a>
`

const getPhotoItems = async ({ limit, page }) => {
  try {
    const res = await fetch(`https://jsonplaceholder.typicode.com/photos?_limit=${limit}&_page=${page}`);
    const total = +res.headers.get('x-total-count');
    const items = await res.json();
    return { items, total };
  } catch (error) {
    console.error('Ошибка загрузки фото:', error);
    throw error; 
  }
}


const init = () => {
    const catalog = document.getElementById('catalog')
    new Catalog(catalog, { 
        renderItem: renderPostItem,
        getItems: getPostItems
     }).init()
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init)
} else {
    init()
}
