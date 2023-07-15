export default class Searcher {
    searchButton: HTMLButtonElement;
    domainInput: HTMLInputElement;

    constructor(searchButton: HTMLButtonElement, domainInput: HTMLInputElement)
    {
        this.searchButton = searchButton;
        this.domainInput = domainInput;

        this.searchButton.addEventListener('click', event => {
            event.preventDefault();
            let domainName = this.domainInput.value,
                servers = [
                    {
                        el: <HTMLElement> document.querySelector('#google-ip'),
                        ip: '8.8.8.8',
                    },
                    {
                        el: <HTMLElement> document.querySelector('#cloudflare-ip'),
                        ip: '1.1.1.1',
                    },
                    {
                        el: <HTMLElement> document.querySelector('#control-d-ip'),
                        ip: '76.76.2.0',
                    },
                    {
                        el: <HTMLElement> document.querySelector('#quad-9-ip'),
                        ip: '9.9.9.9',
                    },
                    {
                        el: <HTMLElement> document.querySelector('#open-dns-ip'),
                        ip: '208.67.222.222',
                    },
                    {
                        el: <HTMLElement> document.querySelector('#clean-browsing-ip'),
                        ip: '185.228.168.9',
                    },
                ],
                targetSelectors = {
                    google: <HTMLElement> document.querySelector('#google-ip'),
                    cloudflare: <HTMLElement> document.querySelector('#cloudflare-ip'),
                    controld: <HTMLElement> document.querySelector('#control-d-ip'),
                    quad9: <HTMLElement> document.querySelector('#quad-9-ip'),
                    opendns: <HTMLElement> document.querySelector('#open-dns-ip'),
                    cleanbrowsing: <HTMLElement> document.querySelector('#clean-browsing-ip'),
                },
                dnsServers = {
                    google: '8.8.8.8',
                    cloudflare: '1.1.1.1',
                    controld: '76.76.2.0',
                    quad9: '9.9.9.9',
                    opendns: '208.67.222.222',
                    cleanbrowsing: '185.228.168.9',
                };

            servers.forEach(server => {
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

interface IDomainSearchResponse
{
    text: string;
    status: number;
    element: HTMLElement;
}