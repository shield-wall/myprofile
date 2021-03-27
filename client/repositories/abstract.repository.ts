import {NuxtAxiosInstance} from "@nuxtjs/axios";
import {ResourceCollectionInterface} from "~/resources/contracts/resource.collection.interface";

export abstract class AbstractRepository
{
  constructor($axios: NuxtAxiosInstance)
  {
    this.axios = $axios;
  }

  all() {
    return this
      .axios
      .get<ResourceCollectionInterface>(this.resource(), {
        transformResponse: (response) => Object.assign(this.collectionInstance(), JSON.parse(response))
      })
      .then(response => response.data)
  }

  abstract resource(): string;

  abstract collectionInstance(): ResourceCollectionInterface
}
