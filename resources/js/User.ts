import Quote from "./Quote";

export default interface User {
  id: number;
  name: string;
  email: string;
  status: string;
  quotes: Quote[];
}