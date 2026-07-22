import { codeToHtml } from 'shiki';

export async function highlightCode(code: string) {
    return codeToHtml(code, {
        lang: 'php',
        theme: 'dark-plus',
        transformers: [
            {
                pre(node) {
                    node.properties.style = `
                        margin:0;
                        padding:12px;
                        font-size:11.5px;
                        line-height:1.3;
                    `;
                },
            },
        ],
    });
}
