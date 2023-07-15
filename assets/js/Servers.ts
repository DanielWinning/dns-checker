import IServerObject from './Interface/IServerObject';

export default class Servers
{
    public static getServers(): Array<IServerObject>
    {
        return [
            {
                ip: '8.8.8.8',
                country: 'usa',
                location: 'Los Angeles',
                provider: 'Google'
            },
            {
                ip: '165.232.38.7',
                country: 'uk',
                location: 'London',
                provider: 'Digital Ocean',
            },
            {
                ip: '46.246.29.69',
                country: 'sweden',
                location: 'Stockholm',
                provider: 'GleSYS AB'
            },
            {
                ip: '185.101.211.184',
                country: 'france',
                location: 'Montpellier',
                provider: 'Absolight SARL'
            },
            {
                ip: '202.53.95.14',
                country: 'india',
                location: 'Hyderabad',
                provider: 'Nettlinx Limited'
            },
            {
                ip: '13.239.88.95',
                country: 'australia',
                location: 'Sydney',
                provider: 'Amazon'
            },
            {
                ip: '223.6.6.41',
                country: 'china',
                location: 'Huangzhou',
                provider: 'Alibaba'
            },
        ];
    }
}