import { ResourceInterface } from '~/resources/contracts/resource.interface'

export abstract class Hydra {
  '@id': string;
  '@type': string;
}

export abstract class HydraCollection extends Hydra {
  '@context': string;
  abstract 'hydra:member': ResourceInterface[];
  'hydra:totalItems': number

  items (): ResourceInterface[] {
    console.log('items')
    return this['hydra:member']
  }

  totalItems (): number {
    return this['hydra:totalItems']
  }
}
