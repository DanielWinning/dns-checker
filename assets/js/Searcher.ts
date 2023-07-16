import IDomainSearchResponse from './Interface/IDomainSearchResponse';
import IServerObject from './Interface/IServerObject';
import Servers from './Servers';

export default class Searcher {
    searchButton: HTMLButtonElement;
    domainInput: HTMLInputElement;
    servers: Array<IServerObject>;

    constructor(searchButton: HTMLButtonElement, domainInput: HTMLInputElement)
    {
        this.searchButton = searchButton;
        this.domainInput = domainInput;
        this.servers = Servers.getServers();

        this.addSearchHandler();
    }

    private addSearchHandler(): void
    {
        this.searchButton.addEventListener('click', (event: Event) => {
            event.preventDefault();

            this.servers.forEach(server => {
                this.search(this.domainInput.value, server.ip, document.querySelector(`#${server.country}`)).then(res => {
                    this.loading(res.element, res.text);
                });
            });
        });
    }

    private async search(domainName: string, dnsProvider: string, outputElement: HTMLElement): Promise<IDomainSearchResponse>
    {
        this.loading(outputElement);

        return new Promise((resolve) => {
            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    resolve({text: xhr.response, status: 200, element: outputElement});
                }
            }

            xhr.open('GET', `/?domain=${domainName}&provider=${dnsProvider}`);
            xhr.send();
        });
    }

    private loading(element: HTMLElement, content: string = ''): void
    {
        if (content === "unknown") {
            element.innerHTML = '<i class="fa-duotone fa-circle-xmark fa-lg"></i>';
            return;
        }

        element.innerHTML = content === '' ? '<img src="/assets/images/spinner.svg" alt="Loading..." class="spinner-img" />'
            : `<i class="fa-duotone fa-circle-check fa-lg"></i> ${content}`;
    }
}