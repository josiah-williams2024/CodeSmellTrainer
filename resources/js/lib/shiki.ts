import {codeToHtml} from 'shiki';

export async function highlightCode(code:string){
    return codeToHtml(code, {
        lang: 'php',
        theme: 'dark-plus',
    });
}
