import IServerObject from './Interface/IServerObject';

export default class Servers
{
    public static getServers(): Array<IServerObject>
    {
        return [
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
        ];
    }
}