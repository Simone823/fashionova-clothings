/*** IMPORTS ***/
import { useEffect } from "react";
/***************************************** */

const useTitle = (title) => {
    // document title change
    useEffect(() => {
        document.title = `Fashionova Clothings | ${title}`;
    }, [title]);
}

export default useTitle;