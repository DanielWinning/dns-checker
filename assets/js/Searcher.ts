import IDomainSearchResponse from './Interface/IDomainSearchResponse';
import Servers from "./Servers";
import IServerObject from "./Interface/IServerObject";

export default class Searcher {
    searchButton: HTMLButtonElement;
    domainInput: HTMLInputElement;
    servers: Array<IServerObject>;

    constructor(searchButton: HTMLButtonElement, domainInput: HTMLInputElement)
    {
        this.searchButton = searchButton;
        this.domainInput = domainInput;
        this.servers = Servers.getServers();

        this.searchButton.addEventListener('click', event => {
            event.preventDefault();
            let domainName = this.domainInput.value;

            this.servers.forEach(server => {
                this.search(domainName, 'A', server.ip, server.el).then(res => {
                    this.loading(res.element, res.text);
                });
            });
        });
    }

    async search(domainName: string, dnsType: string, dnsProvider: string, outputElement: HTMLElement): Promise<IDomainSearchResponse>
    {
        this.loading(outputElement);

        return new Promise((resolve) => {
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resolve({text: xhr.response, status: 200, element: outputElement});
                }
            }

            xhr.open('GET', `/?domain=${domainName}&type=${dnsType}&provider=${dnsProvider}`);
            xhr.send();
        });
    }

    loading(element: HTMLElement, content: string = ''): void
    {
        element.innerHTML = content === '' ? '<img src="/assets/images/spinner.svg" alt="Loading..." class="spinner-img" />'
            : content;
    }
}